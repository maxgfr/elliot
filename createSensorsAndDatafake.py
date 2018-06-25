# -*- coding: utf-8 -*-

import random
from datetime import timedelta, date
import math

def daterange(start, end):
    for i in range(int((end - start).days)+1):
        yield start + timedelta(i)


sql_file = open("sensors_and_data.txt", "w")


accomodation = {"1":{"bedroom1":["temperature", "motion", "luminosity"],
                     "bedroom2":["temperature", "barometer", "humidity", "luminosity"],
                     "kitchen":["barometer", "humidity", "luminosity"],
                     "livingroom":["temperature", "luminosity"],
                     "bathroom":["barometer", "humidity"],
                     "diningroom":["temperature", "barometer", "motion"]}}

"""
accomodation = {"2":{"bedroom":["barometer", "humidity", "luminosity", "motion"],
                     "bathroom":["temperature", "humidity", "motion"],
                     "livingroom":["temperature", "barometer", "humidity", "luminosity", "motion"],
                     "kitchen":["barometer", "luminosity", "motion"]}}

accomodation = {"3":{"bedroom1":["temperature", "humidity", "luminosity", "motion"],
                     "bedroom2":["barometer", "humidity"],
                     "bedroom3":["luminosity"],
                     "bathroom1":["barometer", "humidity"],
                     "bathroom2":["humidity", "luminosity", "motion"],
                     "kitchen":["temperature", "barometer", "luminosity", "motion"],
                     "livingroom":["temperature", "barometer", "humidity", "luminosity", "motion"]}}


accomodation = {"4":{"bedroom":["temperature", "barometer", "humidity", "luminosity", "motion"],
                     "kitchen":["barometer", "luminosity"],
                     "livingroom":["temperature", "humidity", "luminosity"],
                     "diningroom":["temperature", "humidity", "luminosity", "motion"],
                     "bathroom":["humidity"]}}

"""

def hasNumbers(inputString):
    #check if a string has numbers, use to remove the numbers if we have several rooms
    return any(char.isdigit() for char in inputString)

def generateRandomText(lengthOfWord):
    text = ""
    alphabet = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,r,s,t,u,v,w,x,y,z".split(',')
    lengthOfAlphabet = len(alphabet)
    for i in range(lengthOfWord):
        rand = int(math.floor(random.random() * lengthOfAlphabet))
        text += alphabet[rand]
    return text;


def setDataInDatasensors(type_of_sensor):
    data = 0
    if type_of_sensor=="motion":
        data = random.randint(0, 1);
    if type_of_sensor=="barometer":
        data = random.randint(980, 1020);
    if type_of_sensor=="humidity":
        data = random.randint(38, 52);
    if type_of_sensor=="luminosity":
        data = random.randint(0, 100);
    if type_of_sensor=="temperature":
        data = random.randint(18, 25);
    return data

def query():
    sql_query = ""
    date_list = []
    date_start = date(2017, 1, 1)
    date_end = date(2018, 12, 28)

    for dt in daterange(date_start, date_end):
        date_list.append(dt.strftime("%Y-%m-%d"))

    for idOfAccomodation, rooms in accomodation.iteritems():
        for nameOfRoom, sensors in rooms.iteritems():
            if hasNumbers(nameOfRoom):
                nameOfRoom = nameOfRoom[:-1] #delete the last character (the number)

            sql_query += "INSERT INTO room(id_room, name, id_accomodation)"
            sql_query += "SELECT MAX(id_room)+1,"+ "'"+nameOfRoom+"'" +","+ "'"+idOfAccomodation+"'" +" FROM room;"

            for i in range(len(sensors)):
                sql_query += "INSERT INTO sensors(id_sensor, name, state, id_familysensor, id_room)"
                sql_query += "SELECT MAX(id_sensor)+1,"+ "'"+generateRandomText(2)+"'" +", 1, ("
                sql_query += "SELECT id_familysensor FROM familysensor WHERE name = "+ "'"+sensors[i]+"'" +"),("
                sql_query += "SELECT MAX(id_room) FROM room) FROM sensors;"

                for dateTime in date_list:
                    sql_query += "INSERT INTO datasensors(id_datasensor, date_time, value, id_sensor)"
                    sql_query += "SELECT MAX(id_datasensor)+1,"
                    sql_query += "'"+str(dateTime)+"'" +","
                    sql_query += "'"+str(setDataInDatasensors(sensors[i]))+"'" +",("
                    sql_query += "SELECT MAX(id_sensor) FROM sensors) FROM datasensors;"

    return sql_query

sql_file.write(query())
sql_file.close()
