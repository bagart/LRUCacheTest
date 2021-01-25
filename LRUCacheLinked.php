<?php

declare(strict_types=1);

class LRUCacheLinked implements LRUCacheContract
{
    private LimitNode $first;
    private LimitNode $last;
    private int $capacity;

    private array $nodeByKey = [];

    public function __construct(int $capacity)
    {
        if ($capacity <= 0) {
            throw new RuntimeException('capacity value must be great then 0');
        }
        $this->capacity = $capacity;
        $this->first = new LimitNode();
        $this->last = new LimitNode();

        $this->first->setNext($this->last);
        $this->last->setPrevious($this->first);
    }

    private function warm(Node $node)
    {
        $this->unsetNode($node);
        $this->insertNodeAfter($this->first, $node);
    }

    public function get(int $key)
    {
        if (!isset($this->nodeByKey[$key])) {
            return -1;
        }
        $node = $this->nodeByKey[$key];
        $this->warm($node);
        return $node->getData();
    }

    public function put(int $key, $data): void
    {
        $node = $this->nodeByKey[$key] ?? null;
        if ($node) {
            $this->warm($node);
            $node->setData($data);
        } else {
            $node = new Node($key, $data);
            $this->nodeByKey[$key] = $node;
            $this->insertNodeAfter($this->first, $node);

            $this->free(count($this->nodeByKey) - $this->capacity);
        }
    }

    public function free(int $count): void
    {
        while ($count-- > 0) {
            $nodeToRemove = $this->last->getPrevious();
            $this->unsetNode($nodeToRemove);
            unset($this->nodeByKey[$nodeToRemove->getKey()]);
        }
    }

    private function insertNodeAfter(Node $head, Node $node): void
    {
        $node->setNext($head->getNext());
        $node->getNext()->setPrevious($node);

        $node->setPrevious($head);
        $node->getPrevious()->setNext($node);
    }

    private function unsetNode(Node $node): void
    {
        $node->getPrevious()->setNext($node->getNext());
        $node->getNext()->setPrevious($node->getPrevious());
    }

    public function debug(): array
    {
        return [
            'current_count' => count($this->nodeByKey),
            'check' => $this->capacity >= count($this->nodeByKey),
        ];
    }
}

class LimitNode extends Node
{
    public function __construct()
    {
    }
}

class Node
{
    private int $key;
    private $data;
    private Node $next;
    private Node $previous;

    public function __construct(int $key, $data)
    {
        $this->key = $key;
        $this->data = $data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setNext(Node $next)
    {
        $this->next = $next;
    }

    public function setPrevious(Node $previous)
    {
        $this->previous = $previous;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getNext(): Node
    {
        return $this->next;
    }

    public function getPrevious(): Node
    {
        return $this->previous;
    }
}