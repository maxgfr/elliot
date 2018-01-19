# -*- coding: utf-8 -*-
"""
Created on Thu Jan  4 14:33:51 2018

@author: a.terrier
"""

from random import randint
#import radar

from datetime import timedelta, date

def daterange(date1, date2): #création  d'une fonction génératrice qui génère toutes les dates entre date 1 et dat 2
    for n in range(int ((date2 - date1).days)+1):
        yield date1 + timedelta(n)
		

mon_fichier = open("fichier.txt", "w") #ouverture d'un fichier où l'on va écrire la requête






typecapteurs={}
typecapteurs["1"]='température'
typecapteurs["2"]='température'
typecapteurs["3"]='humidity'
typecapteurs["4"]='motion'
typecapteurs["5"]='barometer'
typecapteurs["6"]='humidity'
typecapteurs["7"]='humidity'
typecapteurs["8"]='température'
typecapteurs["9"]='luminosity'
typecapteurs["10"]='barometer'
typecapteurs["11"]='barometer'
typecapteurs["12"]='luminosity'
typecapteurs["13"]='humidity'

def requete():
    sql="INSERT INTO `datasensors` (`id_datasensor`, `date_time`, `value`, `id_sensor`) VALUES "
    i=0
    listedate=[]
    start_dt = date(2016, 1, 1)
    end_dt = date(2018, 2, 28)
    for dt in daterange(start_dt, end_dt):
        listedate.append(dt.strftime("%Y-%m-%d"))
    for dt in listedate:
        for k in range(1, 14) :
            k=str(k)
            i+=1
            if typecapteurs[k] == 'température':
                mesure=randint(18, 25)
            if typecapteurs[k] == 'humidity':
                mesure=randint(38, 52)
            if typecapteurs[k] == 'luminosity':
                mesure=randint(0, 100)
            if typecapteurs[k] == 'barometer':
                mesure=randint(980, 1020)
            if typecapteurs[k] == 'motion':
                mesure=randint(0,1)
            value=(i, str(dt), mesure, k)
            value=str(value)+""",
            """
            sql+=value
    return(sql)
mon_fichier.write(requete())
mon_fichier.close()
    
