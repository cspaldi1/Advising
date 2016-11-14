#!/usr/bin/python

'''
This program reads the winter 2016 course text file
and prints out the extracted relevant information that we need.
to run the file and output to a text file do the following:
./extractCourseInfo.py > out.txt
'''

'''
Index : content
7 : CRN
9: title
5 : courseNO
4 : coursePrefix
term: not in line of file
18 : timeEnd
17 : timeStart
12 : capacity
14 : actual
30 : credits
8 : isHonors
'''

f = open("../../prototype/wi2016.txt", "r")

header = ['CRN', 'title', 'courseNO', 'coursePrefix', 'timeEnd', 'timeStart',
          'capacity', 'actual', 'credits', 'isHonors']
headerString = ";".join(header)
print headerString
for line in f:
    comps = line.split(';')
    subset = [comps[7].strip(), comps[9].strip(), comps[5].strip(), comps[4].strip(),
              comps[18].strip(), comps[17].strip(), comps[12].strip(), comps[14].strip(),
              comps[30].strip(), comps[8].strip()]
    lineToPrint = ';'.join(subset)
    print lineToPrint

'''
line = f.readline()
comps = line.split(";")
for i in xrange(0, len(comps)):
    print "i: " + str(i) + ", info: " + str(comps[i])
'''