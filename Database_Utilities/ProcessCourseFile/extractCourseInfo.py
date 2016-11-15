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

# def makeFloat(floatString):


def makeInt(intString):
    """
    Turns an integer-like string into an integer by trimming off the leading zeroes
    and returning the integer corresponding to it
    :param intString: (type: string)
    :return: (type: int) int corresponding to the string
    """
    index_of_first_non_zero_digit = 0
    for i in xrange(0, len(intString)):
        if intString[i].isdigit() and intString[i] != '0':
            index_of_first_non_zero_digit = i
            break
    trimmed_int_string = intString[index_of_first_non_zero_digit:]
    return int(trimmed_int_string)

f = open("../../prototype/wi2016.txt", "r")

header = ['CRN', 'title', 'courseNO', 'coursePrefix', 'timeEnd', 'timeStart',
          'capacity', 'actual', 'credits', 'isHonors']
headerString = ";".join(header)
print headerString

my_set = set()

for line in f:
    comps = line.split(';')
    my_set.add(comps[12].strip())
    if comps[12].strip() == 'WW5':
        print line
        print "len: " + str(len(comps))
    elif comps[12].strip() == '0122':
        print line
        print "len: " + str(len(comps))
    '''
    subset = [comps[7].strip(), comps[9].strip(), comps[5].strip(), comps[4].strip(),
              comps[18].strip(), comps[17].strip(), comps[12].strip(), comps[14].strip(),
              comps[30].strip(), comps[8].strip()]
    lineToPrint = ';'.join(subset)
    print lineToPrint
    '''
print my_set
'''
line = f.readline()
comps = line.split(";")
for i in xrange(0, len(comps)):
    print "i: " + str(i) + ", info: " + str(comps[i])
'''