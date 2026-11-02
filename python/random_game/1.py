import random

x=random.randint(1,100)
i=0

print("guess x . it's a random between 1 and 100")

while True:
    try:
        guess=int(input("Enter your guess: "))
        i+=1
        if guess < x:
            print("higher")
        elif guess > x:
            print("lower")
        else:
            print(f"congrats !! u won. x was {x}")
            print(f"you  tries {i}")
            break
    
    except ValueError:
        print("enter a valid number")