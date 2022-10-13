# import required modules
import socket
import threading
import tkinter as tk
from tkinter import scrolledtext
from tkinter import messagebox

HOST = '127.0.0.1'
PORT = 1234

DARK_GREY = '#121212'
MEDIUM_GREY = '#1F1B24'
OCEAN_BLUE = '#464EB8'
WHITE = "white"
FONT = ("Helvetica", 17)
BUTTON_FONT = ("Helvetica", 15)
SMALL_FONT = ("Helvetica", 13)

# Creating a socket object
# AF_INET: we are going to use IPv4 addresses
# SOCK_STREAM: we are using TCP packets for communication
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)


def add_message(message):
    message_box.config(state=tk.NORMAL)
    message_box.insert(tk.END, message + '\n')
    message_box.config(state=tk.DISABLED)


def connect():
    try:

        # Connection au serveur
        client.connect((HOST, PORT))
        print("Connection au serveur reussi")
        add_message("[SERVER] Connection au serveur reussi")
    except:
        messagebox.showerror("Connection refuser", f"Connection refuser {HOST} {PORT}")

    nom = nom_textbox.get()
    if nom != '':
        client.sendall(nom.encode())
    else:
        messagebox.showerror("Nom d'utilisateur incorrect", "Le nom d'utilisateur ne peut pas être vide")

    threading.Thread(target=listen_for_messages_from_server, args=(client,)).start()

    nom_textbox.config(state=tk.DISABLED)
    nom_button.config(state=tk.DISABLED)


def send_message():
    msg = message_textbox.get()
    if msg != '':
        client.sendall(msg.encode())
        message_textbox.delete(0, len(msg))
    else:
        messagebox.showerror("Message vide", "Le message ne doit aps être vide")

# Fait sur le site Visual TK

root = tk.Tk()
root.geometry("600x600")
root.title("Chat Room")
root.resizable(False, False)

root.grid_rowconfigure(0, weight=1)
root.grid_rowconfigure(1, weight=4)
root.grid_rowconfigure(2, weight=1)

top_frame = tk.Frame(root, width=600, height=100, bg=DARK_GREY)
top_frame.grid(row=0, column=0, sticky=tk.NSEW)

middle_frame = tk.Frame(root, width=600, height=400, bg=MEDIUM_GREY)
middle_frame.grid(row=1, column=0, sticky=tk.NSEW)

bottom_frame = tk.Frame(root, width=600, height=100, bg=DARK_GREY)
bottom_frame.grid(row=2, column=0, sticky=tk.NSEW)

nom_label = tk.Label(top_frame, text="Enter nom:", font=FONT, bg=DARK_GREY, fg=WHITE)
nom_label.pack(side=tk.LEFT, padx=10)

nom_textbox = tk.Entry(top_frame, font=FONT, bg=MEDIUM_GREY, fg=WHITE, width=23)
nom_textbox.pack(side=tk.LEFT)

nom_button = tk.Button(top_frame, text="Join", font=BUTTON_FONT, bg=OCEAN_BLUE, fg=WHITE, command=connect)
nom_button.pack(side=tk.LEFT, padx=15)

message_textbox = tk.Entry(bottom_frame, font=FONT, bg=MEDIUM_GREY, fg=WHITE, width=38)
message_textbox.pack(side=tk.LEFT, padx=10)

message_button = tk.Button(bottom_frame, text="Send", font=BUTTON_FONT, bg=OCEAN_BLUE, fg=WHITE, command=send_message)
message_button.pack(side=tk.LEFT, padx=10)

message_box = scrolledtext.ScrolledText(middle_frame, font=SMALL_FONT, bg=MEDIUM_GREY, fg=WHITE, width=67, height=26.5)
message_box.config(state=tk.DISABLED)
message_box.pack(side=tk.TOP)


# Fait sur le site Visual TK


def listen_for_messages_from_server(client):
    while 1:

        message = client.recv(2048).decode('utf-8')
        if message != '':
            nom = message.split("~")[0]
            content = message.split('~')[1]
            #Affiche qui a envoyer quel message
            add_message(f"[{nom}] {content}")

        else:
            #Message d'erreur
            messagebox.showerror("Error", "Message reçus du client vide")


# main function
def main():
    root.mainloop()


if __name__ == '__main__':
    main()
