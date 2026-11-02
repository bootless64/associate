import tkinter as tk 
from tkinter import messagebox
import string
import random
import qrcode
from PIL import ImageTk, Image 

def generate_password():
    try:
        length = int(length_entry.get())
        if length < 4:
            messagebox.showwarning("Error","Min lengh should be 4 char")
            return 
        characters = string.ascii_letters + string.digits + string.punctuation
        password = ''.join(random.choice(characters) for _ in range(length))
        result_label.config(text=password)

        qr_label.config(image='',text='')
        
    except ValueError:
        messagebox.showerror("error","Enter a valid number")

def copy_to_clipboard():
    password = result_label.cget("text")
    if not password:
        messagebox.showwarning("error","There is no password generated")
        return
    root.clipboard_clear()
    root.clipboard_append(password)
    messagebox.showinfo("coppied","Successful")
def create_qr():
    password = result_label.cget("text")
    if not password:
        messagebox.showwarning("error","Generate a password first")
        return

    qr = qrcode.make(password)
    qr.save("password_qr.png")

    img = Image.open("password_qr.png").resize((150, 150))
    img_tk = ImageTk.PhotoImage(img)
    qr_label.config(image=img_tk)
    qr_label.image = img_tk

root = tk.Tk()
root.title("Password maker with QR")
root.geometry("450x500")

tk.Label(root, text="Enter the lengh", font=("Arial",12)).pack(pady=10)        
length_entry = tk.Entry(root, font=("Arial",12), width=10)   
length_entry.pack()


btn_frame=tk.Frame(root)
btn_frame.pack(pady=10)


tk.Button(btn_frame, text="Procced", font=("Arial",12, "bold"),
            bg="#1D8320", fg="white", command=generate_password).pack(side="left",padx=5)

tk.Button(btn_frame, text="copy", font=("Arial",12, "bold"),
            bg="#1288F7", fg="white", command=copy_to_clipboard).pack(side="left",padx=5)

tk.Button(btn_frame, text="Make QR", font=("Arial",12, "bold"),
            bg="#FF2D08", fg="white", command=create_qr).pack(side="left",padx=5)


tk.Label(root, text="Generated password is: ", font=("Arial",12)).pack()
result_label = tk.Label(root, text="",font=("Arial",14, "bold"), fg="blue")
result_label.pack(pady=10)

qr_label = tk.Label(root, text="", font=("Arial", 12))
qr_label.pack(pady=10)

root.mainloop()