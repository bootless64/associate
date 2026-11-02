import tkinter as tk
import os, sys, subprocess
from tkinter import messagebox

def open_tool(tool_name):
    try:
        if sys.platform.startswith('win'):
            os.system(f"start pythonw {tool_name}")
        else:
            subprocess.Popen(['python3', tool_name])
    except Exception as e:
        messagebox.showerror("Error!", f"failed to open {tool_name}\n\n{e}")

root = tk.Tk()
root.title("Multifunction application")
root.geometry("300x400")

tk.Label(root, text="Multifunction application", font=("Arial", 14, "bold")).pack(pady=20)

tk.Button(root, text="calculator", width=20,
          command=lambda: open_tool("calculator/cal.py")).pack(pady=10)

tk.Button(root, text="password generator", width=20,
          command=lambda: open_tool("password_gen/pass.py")).pack(pady=10)

tk.Button(root, text="Timer", width=20,
          command=lambda: open_tool("timer/countdown.py")).pack(pady=10)

tk.Button(root, text="Global clock", width=20,
          command=lambda: open_tool("world_clock/clock.py")).pack(pady=10)

tk.Button(root, text="❌ Exit ", width=20, fg="red",
          command=root.destroy).pack(pady=30)

root.mainloop()