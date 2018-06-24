import requests

liste = ["A", "B", "C", "D", "E", "F", "G"]

for i in range(12):
    url = "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=G"
    j = str(i)
    if i < 10:
        j = "0" + j
    for l in range(len(liste)):
        url2 = url
	url2 += j
	url2 += liste[l]
	r = requests.get(url2, allow_redirects=True)
	if "ERREUR" not in r.text:
            print(url2 + "   fonctionne")
