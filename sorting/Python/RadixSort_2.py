import time
import random
def radixsort( aList ):
  RADIX = 10
  maxLength = False
  tmp , placement = -1, 1
 
  while not maxLength:
    maxLength = True
    # declare and initialize buckets
    buckets = [list() for _ in range( RADIX )]
 
    # split aList between lists
    for  i in aList:
      tmp = i / placement
      buckets[tmp % RADIX].append( i )
      if maxLength and tmp > 0:
        maxLength = False
 
    # empty lists into aList array
    a = 0
    for b in range( RADIX ):
      buck = buckets[b]
      for i in buck:
        aList[a] = i
        a += 1
 
    # move to next digit
    placement *= RADIX

for i in range(0,10):
    alist = []
    for j in range(0,1000):
        alist.append(int(random.random()*1000000))
    t1=time.time()
    radixsort(alist)
    t2=time.time()
    print(t2-t1)
print("")    
for i in range(0,10):
    alist = []
    for j in range(0,5000):
        alist.append(int(random.random()*1000000))
    t1=time.time()
    radixsort(alist)
    t2=time.time()
    print(t2-t1)
print("")    
for i in range(0,10):
    alist = []
    for j in range(0,10000):
        alist.append(int(random.random()*1000000))
    t1=time.time()
    radixsort(alist)
    t2=time.time()
    print(t2-t1)
print("")    
for i in range(0,10):
    alist = []
    for j in range(0,50000):
        alist.append(int(random.random()*1000000))
    t1=time.time()
    radixsort(alist)
    t2=time.time()
    print(t2-t1)
print("")
for i in range(0,10):
    alist = []
    for j in range(0,100000):
        alist.append(int(random.random()*1000000))
    t1=time.time()
    radixsort(alist)
    t2=time.time()
    print(t2-t1)
