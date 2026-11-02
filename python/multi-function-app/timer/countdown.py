import tkinter as tk
import threading
import time

root = tk.Tk()
root.title("countdown")
root.geometry("350x220")

tk.Label(root, text="Enter seconds :", font=("Arial", 12)).pack(pady=8)

entry_time = tk.Entry(root, font=("Arial", 12), width=10)
entry_time.pack()

btn_frame = tk.Frame(root)
btn_frame.pack(pady=10)

def start_timer():
    t = entry_time.get()
    if t.isdigit():
        t = int(t)
        start_button.config(state="disabled")
        stop_button.config(state="normal")
        threading.Thread(target=run_timer, args=(t,), daemon=True).start()

def stop_timer():
    global running
    running = False
    start_button.config(state="normal")
    stop_button.config(state="disabled")

def run_timer(seconds):
    global running
    running = True
    while seconds >= 0 and running:
        mins, secs = divmod(seconds, 60)
        timer_display.config(text=f"{mins:02d}:{secs:02d}")
        time.sleep(1)
        seconds -= 1
    start_button.config(state="normal")
    stop_button.config(state="disabled")

start_button = tk.Button(
    btn_frame, text="start", width=10,
    command=start_timer, bg="#4CAF50", fg="white"
)
start_button.grid(row=0, column=0, padx=5)

stop_button = tk.Button(
    btn_frame, text="stop", width=10,
    command=stop_timer, state="disabled",
    bg="#f44336", fg="white"
)
stop_button.grid(row=0, column=1, padx=5)

timer_display = tk.Label(root, text="00:00", font=("Arial", 30, "bold"), fg="blue")
timer_display.pack(pady=10)

running = True
root.mainloop()
