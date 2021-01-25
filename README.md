# LRUCache examples with benchmarks on PHP
https://leetcode.com/problems/lru-cache/

Done: Index and Linked

## Results:
LRUCacheIndexed
```
$ time php test.php
array(6) {
  ["class"]=>
  string(15) "LRUCacheIndexed"
  ["time"]=>
  string(7) "10.8sec"
  ["crc32"]=>
  int(2572008297)
  ["mem_peak"]=>
  string(7) "50.42mb"
  ["mem_current"]=>
  string(7) "40.42mb"
  ["debug"]=>
  array(2) {
    ["current_count"]=>
    int(500000)
    ["check"]=>
    bool(true)
  }
}

real    0m10.832s
user    0m0.000s
sys     0m0.000s
```

LRUCacheLinked
````
array(6) {
  ["class"]=>
  string(14) "LRUCacheLinked"
  ["time"]=>
  string(7) "22.9sec"
  ["crc32"]=>
  int(2572008297)
  ["mem_peak"]=>
  string(7) "81.65mb"
  ["mem_current"]=>
  string(7) "77.81mb"
  ["debug"]=>
  array(2) {
    ["current_count"]=>
    int(500000)
    ["check"]=>
    bool(true)
  }
}

real    0m23.047s
user    0m0.015s
sys     0m0.000s

```