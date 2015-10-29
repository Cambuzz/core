import time
import random
def bubbleSort(alist):
    for passnum in range(len(alist)-1,0,-1):
        for i in range(passnum):
            if alist[i]>alist[i+1]:
                temp = alist[i]
                alist[i] = alist[i+1]
                alist[i+1] = temp

for i in range(0,2):
    alist = []
    for j in range(0,50000):
        alist.append(int(random.random()*1000000))
    t1=time.time()
    bubbleSort(alist)
    t2=time.time()
    print(t2-t1)
