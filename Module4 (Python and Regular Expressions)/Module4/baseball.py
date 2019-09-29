import sys, os
import re
import pandas as pd

if len(sys.argv) < 2:
    sys.exit(f"Usage: {sys.argv[0]} filename")

filename = sys.argv[1]

if not os.path.exists(filename):
    sys.exit(f"Error: File '{sys.argv[1]}' not found")

f = open(filename)
file_contents = f.read().splitlines() #Reference from: https://stackoverflow.com/questions/12330522/reading-a-file-without-newlines
f.close()

email_regex = re.compile(r"(\b\w*[A-Z]{1}\w*\b \b\w*[A-Z]{1}\w*\b) batted (\d) times with (\d) hits")
lines = []

def find_all_email_domains(test):
    for (name, times, hit) in email_regex.findall(test):
        return [name, times, hit]

for line in file_contents[4:]:
    l = find_all_email_domains(line)
    if l == None:
        pass
    else:
        l[1] = int(l[1])
        l[2] = int(l[2])
        lines.append(l)
        
data=pd.DataFrame(lines)
data.columns = ['name', 'bat', 'hit']

new_groupby = pd.DataFrame(data.groupby("name").sum())
new_groupby['avg_bat'] = new_groupby['hit']/new_groupby['bat']

for idx, row in new_groupby.sort_values(by='avg_bat', ascending=False).iterrows():
    print(idx+": "+str(round(row["avg_bat"],3)))