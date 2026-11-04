import cv2
import numpy as np

image = cv2.imread('img1.jpg')
height , width , channel = image.shape

mask = np.zeros((height , width ,3),dtype=np.uint8)
circle = cv2.circle(mask,(height//2 , width//2), height//2 ,(255,255,255),-1)
# cv2.imshow('mask-image',circle)

mask_image = cv2.bitwise_and(image,circle)

# cv2.imshow('mask-image',mask_image)

transparent_image = np.zeros((height,width,4),dtype=np.uint8)
transparent_image[: , : , 0:3] = image

mask = np.zeros((height , width ),dtype=np.uint8)
circle = cv2.circle(mask,(height//2 , width//2), height//2 ,(255,255,255),-1)
transparent_image[: , : , 3] = circle

cv2.imshow('Final transparent image',transparent_image)
cv2.imwrite('pic.png',transparent_image)

cv2.waitKey()
cv2.destroyAllWindows()