import csv
import json

def CSVtoJSON_converter(csv_path, json_path):
    jsonData = {}

    with open(csv_path, encoding='utf-8') as csvfile:
        csvData = csv.DictReader(csvfile)

        for rows in csvData:
            key = rows['SrNo']
            jsonData[key] = rows

    with open(json_path, 'w', encoding='utf-8') as jsonfile:
        jsonfile.write(json.dumps(jsonData))

csv_path = r'med.csv'
json_path = r'med.JSON'

CSVtoJSON_converter(csv_path=csv_path, json_path=json_path)
