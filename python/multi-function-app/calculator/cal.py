import tkinter as tk
from tkinter import messagebox
import random

root = tk.Tk()
root.title("Calculator")
root.geometry("300x400")
root.resizable(False, False)

entry = tk.Entry(root, width=20, font=("Arial", 18), borderwidth=3, relief="solid", justify="right")
entry.grid(row=0, column=0, columnspan=4, padx=10, pady=20)

def calculate():
    expression = entry.get()
    try:
        result = eval(expression)
        entry.delete(0, tk.END)
        entry.insert(0, str(result))
    except ZeroDivisionError:
        messagebox.showerror("Error", "Division by zero")
    except Exception:
        messagebox.showerror("Error", "Invalid input")

def clear():
    entry.delete(0, tk.END)

buttons = [
    ('7',1,0),('8',1,1),('9',1,2),('/',1,3),
    ('4',2,0),('5',2,1),('6',2,2),('*',2,3),
    ('1',3,0),('2',3,1),('3',3,2),('-',3,3),
    ('0',4,0),('.',4,1),('C',4,2),('+',4,3),
    ('=',5,0)
]

for (text,row,col) in buttons:
    if text == "=":
        btn = tk.Button(root, text=text, width=26, height=2, command=calculate)
        btn.grid(row=row, column=col, columnspan=4, pady=5)
    elif text == "C":
        btn = tk.Button(root, text=text, width=5, height=2, command=clear)
        btn.grid(row=row, column=col, padx=5, pady=5)
    else:
        btn = tk.Button(root, text=text, width=5, height=2, command=lambda t=text: entry.insert(tk.END, t))
        btn.grid(row=row, column=col, padx=5, pady=5)

root.mainloop()
