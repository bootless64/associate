import tkinter as tk 
from time import strftime
import pytz
from datetime import datetime

def time():
    localnow=datetime.now()
    utcnow=datetime.now(pytz.timezone("Europe/London"))
    utc.config(text=f"London time :{utcnow.strftime('%H:%M:%S')}")
    local.config(text=f"local time :{localnow.strftime('%H:%M:%S')}")

    root.after(500,time)
    

root=tk.Tk()
root.title("Global clock")
root.geometry("400x300")
root.resizable(False,False)

tk.Label(root, text="clock", font=("Arial", 14, "bold")).pack(pady=20)


utc= tk.Label(root, text="London clock :", font=("Arial", 14, "bold"))
utc.pack(pady=10)
local=tk.Label(root, text="local clock :", font=("Arial", 14, "bold"))
local.pack(pady=20)

time()


root.mainloop()