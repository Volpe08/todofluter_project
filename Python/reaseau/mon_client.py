# coding: utf-8

import socket

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect(('', 1111))

print("Entrez le nom du fichier que vous voulez récupérer:") # le fichier ne doit pas être vide
file_name = input(">> ") 
sock.send(file_name.encode())
file_name = 'depot/%s' % (file_name,)
data = sock.recv(1024)
with open(file_name,'wb') as _file:
    _file.write(data)
print("Le fichier a été récupéré : %s." % file_name)