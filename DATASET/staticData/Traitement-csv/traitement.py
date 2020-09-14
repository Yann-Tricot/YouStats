import csv
import sys
import datetime
from datetime import date

def dateTreatment(DateDebut, DateFin):
    
    delta = DateFin - DateDebut
    return delta

#test si les 2 dates ont bien été mise en paramètre
if(len(sys.argv)<3):
    print("Il manque des arguments ! py traitement.py <arg1> <arg2> lire le README")
    sys.exit()

#test si le premier paramètre est une date au bon format
try:
    StartingDate = datetime.datetime.strptime(sys.argv[1], '%Y.%m.%d')
except ValueError:
    print("Le première date n'est pas au bon format! (%Y.%m.%d) lire le README")
    sys.exit()


#liste de fichiers de pays qui seront ouvert
country_list = ['FR','DE','IT','US','CA','MX','BR','AR','CL','JP','IN','KR','ZA','DZ','MA','AU','RU']

#permet de tester si la deuxième date est bien une date au bon format
try:
    finalDate = datetime.datetime.strptime(sys.argv[2], '%Y.%m.%d')
except ValueError:
    print("La deuxième date n'est pas au bon format! (%Y.%m.%d) lire le README")
    sys.exit()

#calcul du nombre de jours à traiter
days = dateTreatment(StartingDate,finalDate).days
CurrentDate = StartingDate
for i in range(days+1):
    for country in country_list:
        #ouverture des fichiers 
        file = open("input/"+datetime.date.strftime(CurrentDate, "%y.%d.%m_")+country+"_videos.csv",'r',encoding='utf8')
        #lit le fichier
        reader = csv.DictReader(file, delimiter=',')
        liste_releves = []
        for row in reader:
            liste_releves.append({'video_id' : row['video_id'],
                                'title' : row['title'],
                                'publishedAt' : row['publishedAt'],
                                'channelId' : row['channelId'],
                                'channelTitle' : row['channelTitle'],
                                'categoryId' : row['categoryId'],
                                'trending_date' : row['trending_date'],
                                'tags' : row['tags'],
                                'view_count' : row['view_count'],
                                'likes' : row['likes'],
                                'dislikes' : row['dislikes'],
                                'comment_count' : row['comment_count'],
                                'thumbnail_link' : row['thumbnail_link'],
                                'comments_disabled' : row['comments_disabled'], #ligne supprimé
                                'ratings_disabled' : row['ratings_disabled'],
                                'description' : row['description'],#  #ligne supprimé
                                'country' : country})           
        file.close()
        
        #création des fichiers outuput
        fileout = open("output/"+datetime.date.strftime(CurrentDate, "%y.%d.%m_")+country+"_output.csv",'w+',encoding='utf8',newline='')
        fieldnames = ['video_id','title','publishedAt','channelId','channelTitle','categoryId','trending_date','tags','view_count','likes','dislikes','comment_count','thumbnail_link','ratings_disabled','country']
        writer = csv.DictWriter(fileout, fieldnames=fieldnames)

        #writer.writeheader()
        for row in liste_releves: 
            #suppression des lignes que l'on ne souhaite pas
            del row['comments_disabled']  
            del row['description']
            #ecrit dans le fichier
            writer.writerow(row)

        fileout.close()
    CurrentDate = CurrentDate + datetime.timedelta(days=1)



