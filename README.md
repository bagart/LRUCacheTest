# LRUCache examples with benchmarks on PHP
https://leetcode.com/problems/lru-cache/

Done: Index and Linked

## Results:
```
array(6) {
  ["class"]=>
  string(14) "LRUCacheLinked"
  ["time"]=>
  string(7) "5.97sec"
  ["result"]=>
  int(1988311147)
  ["mem_peak"]=>
  string(8) "124.41mb"
  ["mem_current"]=>
  string(8) "112.27mb"
  ["debug"]=>
  array(2) {
    ["current_count"]=>
    int(597890)
    ["check"]=>
    bool(true)
  }
}

real    0m6.152s
user    0m0.000s
sys     0m0.016s


array(6) {
  ["class"]=>
  string(15) "LRUCacheIndexed"
  ["time"]=>
  string(7) "4.72sec"
  ["result"]=>
  int(1988311147)
  ["mem_peak"]=>
  string(8) "100.42mb"
  ["mem_current"]=>
  string(7) "80.42mb"
  ["debug"]=>
  array(2) {
    ["current_count"]=>
    int(597890)
    ["check"]=>
    bool(true)
  }
}

real    0m4.754s
user    0m0.000s
sys     0m0.000s

```