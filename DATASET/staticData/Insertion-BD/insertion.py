import pymysql.cursors 
import csv
import sys
import datetime
from datetime import date

try:
    connection = pymysql.connect(host='localhost',
                                user='root',
                                password='',                             
                                db='youstats',
                                charset='utf8mb4'#,
                                #cursorclass=pymysql.cursors.DictCursor
                                )
    print("connect successful!!")

except ValueError:
    print("Echec de la connection au serveur !")

try:
  
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
            print(country)
            #ouverture des fichiers 
            file = open("input/"+datetime.date.strftime(CurrentDate, "%y.%d.%m_")+country+"_output.csv",'r',encoding='utf8')
            print(file.name)
            #lit le fichier
            reader = csv.DictReader(file, delimiter=',')
            liste_releves = []
            for row in reader:         
                with connection.cursor() as cursor:
                    #ADD data in channel table 
                    sqlChannel = "INSERT into channel Values('"+row['channelId']+"','"+row['channelTitle']+"')"

                    #ADD data in Video table
                    sqlVideo = "INSERT ignore into Video Values('"+row['video_id']+"','"+row['title']+"','"+row['publishedAt']+"','"+row['likes']+"','"+row['dislikes']+"','"+row['comment_count']+"','"+row['categoryId']+"','"+row['comment_count']+"','"+row['thumbnail_link']+"')"

                    #ADD data in tags table
                    sqlTags = "INSERT into Tag (tagName) Values('"+row['tags']+"')"
                    cursor.execute(sqlChannel)
                    cursor.execute(sqlVideo)
                    cursor.execute(sqlTags)
 
            file.close()          
        CurrentDate = CurrentDate + datetime.timedelta(days=1)

finally:
    connection.commit()
    # Closez la connexion (Close connection).      
    connection.close()