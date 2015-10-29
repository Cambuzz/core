import time
import random
def selectionSort(alist):
   for fillslot in range(len(alist)-1,0,-1):
       positionOfMax=0
       for location in range(1,fillslot+1):
           if alist[location]>alist[positionOfMax]:
               positionOfMax = location

       temp = alist[fillslot]
       alist[fillslot] = alist[positionOfMax]
       alist[positionOfMax] = temp

for i in range(0,3):

    alist = []
    for j in range (0,50000):
        alist.append(int(random.random()))
    t1=time.time()
    selectionSort(alist)
    t2=time.time()
    print(t2-t1)
