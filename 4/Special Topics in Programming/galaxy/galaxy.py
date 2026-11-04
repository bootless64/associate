import tkinter as tk
import random

# Initialize main window
root = tk.Tk()
root.title("Space Shooter")
root.geometry("800x600")
root.configure(bg="black")

# Player position
px, py = 400, 520
score, lives = 0, 3
bullets, enemies = [], []
game_running = True

# Create player (using simple shape instead of GIF)
player = tk.Label(root, text="▲", fg="cyan", bg="black", font=("Arial", 30))
player.place(x=px, y=py)

# Score and lives display
score_label = tk.Label(root, text="Score: 0", fg="white", bg="black", font=("Arial", 16))
score_label.place(x=10, y=10)

lives_label = tk.Label(root, text="Lives: 3", fg="red", bg="black", font=("Arial", 16))
lives_label.place(x=10, y=40)

# Movement functions
def left(e):
    global px
    if game_running and px > 30:
        px -= 30
        player.place(x=px, y=py)

def right(e):
    global px
    if game_running and px < 770:
        px += 30
        player.place(x=px, y=py)

def up(e):
    global py
    if game_running and py > 50:
        py -= 30
        player.place(x=px, y=py)

def down(e):
    global py
    if game_running and py < 550:
        py += 30
        player.place(x=px, y=py)

# Shoot function
def shoot(e):
    if not game_running:
        return
    # Create bullet
    b = tk.Label(root, text="|", fg="yellow", bg="black", font=("Arial", 10, "bold"))
    b.place(x=px + 12, y=py-15)
    bullets.append([b, px + 12, py-15])

# Create new enemy
def new_enemy():
    if not game_running:
        return
    x = random.randint(30, 770)
    e = tk.Label(root, text="▼", fg="red", bg="black", font=("Arial", 30))
    e.place(x=x, y=30)
    enemies.append([e, x, 30])
    root.after(2000, new_enemy)

# Main game loop
def game_loop():
    global score, lives, game_running
    
    if not game_running:
        return
    
    # Move bullets
    i = 0
    while i < len(bullets):
        bullet = bullets[i]
        bullet[2] -= 15  # Bullet speed
        bullet[0].place(x=bullet[1], y=bullet[2])
        
        # Remove bullet if off screen
        if bullet[2] < 0:
            bullet[0].destroy()
            bullets.pop(i)
        else:
            i += 1
    
    # Move enemies and check collisions
    j = 0
    while j < len(enemies):
        enemy = enemies[j]
        enemy[2] += 5  # Enemy speed
        enemy[0].place(x=enemy[1], y=enemy[2])
        
        # Remove enemy if off screen
        if enemy[2] > 600:
            enemy[0].destroy()
            enemies.pop(j)
            continue
        
        # Check bullet-enemy collision
        hit = False
        k = 0
        while k < len(bullets):
            bullet = bullets[k]
            # Collision detection range
            #bullets.append([b, px + 12, py-15])
            #enemies.append([e, x, 30])

            if (bullet[1] > enemy[1] and bullet[1] < enemy[1] + 30 and
                bullet[2] > enemy[2] and bullet[2] < enemy[2] + 30):
                
                # برخورد!
                bullet[0].destroy()
                bullets.pop(k)
                hit = True
                break
            k += 1
        
        # If hit, destroy enemy and add score
        if hit:
            enemy[0].destroy()
            enemies.pop(j)
            score += 10
            score_label.config(text=f"Score: {score}")
            continue
        
        # Check player-enemy collision
        if (px > enemy[1] and px < enemy[1] + 30 and
            py > enemy[2] and py < enemy[2] + 30):
            
            enemy[0].destroy()
            enemies.pop(j)
            lives -= 1
            lives_label.config(text=f"Lives: {lives}")
            
            # Game over condition
            if lives == 0:
                game_running = False
                game_over = tk.Label(root, text="GAME OVER", fg="red", bg="black", font=("Arial", 40, "bold"))
                game_over.place(x=300, y=250)
                
                # Restart button
                restart_btn = tk.Button(root, text="Play Again", command=restart_game, 
                                       font=("Arial", 14), bg="yellow", fg="black")
                restart_btn.place(x=350, y=350)
                return
            continue
        
        j += 1
    
    # Continue game loop
    root.after(50, game_loop)

# Restart game function
def restart_game():
    global px, py, score, lives, bullets, enemies, game_running
    
    # Clear all game objects
    for bullet, _, _ in bullets:
        bullet.destroy()
    for enemy, _, _ in enemies:
        enemy.destroy()
    
    # Reset variables
    px, py = 400, 520
    score, lives = 0, 3
    bullets, enemies = [], []
    game_running = True
    
    # Reset display
    player.place(x=px, y=py)
    score_label.config(text="Score: 0")
    lives_label.config(text="Lives: 3")
    
    # Remove game over message and restart button
    for widget in root.winfo_children():
        if isinstance(widget, tk.Label) and widget.cget("text") == "GAME OVER":
            widget.destroy()
        if isinstance(widget, tk.Button) and widget.cget("text") == "Play Again":
            widget.destroy()
    
    # Start new game
    new_enemy()
    game_loop()

# Key bindings
root.bind("<Left>", left)
root.bind("<Right>", right)
root.bind("<Up>", up)
root.bind("<Down>", down)
root.bind("<space>", shoot)
root.focus_set()  # Ensure keyboard input is received

# Start the game
new_enemy()
game_loop()
root.mainloop()