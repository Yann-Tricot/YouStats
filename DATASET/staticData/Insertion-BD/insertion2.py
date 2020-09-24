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

try :

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
            i = 0
            for row in reader:         
                with connection.cursor() as cursor:
                    #ADD data in tags table
                    sqlTags = "INSERT into Tag (tag_name) Values('"+row['tags'].replace('\'','')+"')"
                    cursor.execute(sqlTags)

                    sqltagID = "select tag_id from tag where tag_name = '" + row['tags'].replace('\'','')+"'"
                    cursor.execute(sqltagID)
                    idTag = cursor.fetchone()
                    #ADD data in channel table 
                    sqlChannel = "INSERT ignore into channel Values('"+row['channelId'].replace('\'','')+"','"+row['channelTitle'].replace('\'','')+"','"+country+"')"

                    #ADD data in Video table
                    sqlVideo = "INSERT ignore into Video (video_id,title_video,published_date,count_like,count_dislike,count_comment,category_id,trending_date,miniature_link,tag_id,channel_id,country,classement,duration,count_view)Values ('"+row['video_id'].replace('\'','')+"','"+row['title'].replace('\'','')+"','"+row['publishedAt'].replace('\'','')+"','"+row['likes'].replace('\'','')+"','"+row['dislikes'].replace('\'','')+"','"+row['comment_count'].replace('\'','')+"','"+row['categoryId'].replace('\'','')+"','"+str(CurrentDate)+"','"+row['thumbnail_link'].replace('\'','')+"','"+str(idTag[0])+"','"+row['channelId'].replace('\'','')+"','"+country+"','"+str((i+1))+"','"+row['duration']+"','"+row['view_count']+"')"
                     
                    cursor.execute(sqlChannel)
                    cursor.execute(sqlVideo)
                    #cursor.execute(sqlTags)
                i+=1
            file.close()
        CurrentDate = CurrentDate + datetime.timedelta(days=1)

finally:
    connection.commit()

    # Closez la connexion (Close connection).      
    connection.close()

