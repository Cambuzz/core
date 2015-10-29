import time
import random
def insertionSort(alist):
   for index in range(1,len(alist)):

     currentvalue = alist[index]
     position = index

     while position>0 and alist[position-1]>currentvalue:
         alist[position]=alist[position-1]
         position = position-1

     alist[position]=currentvalue
for i in range (0,10):

   alist = []
   for j in range (0,10000):
      alist.append(int(random.random()*1000000))
   t1=time.time()
   insertionSort(alist)
   t2=time.time()
   print(t2-t1)
