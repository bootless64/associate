import cv2
import numpy as np 

image = cv2.imread("image.png", cv2.IMREAD_COLOR)
image2 = cv2.imread("image.png", cv2.IMREAD_GRAYSCALE)


cv2.imwrite("newImageName.jpg",image)

cv2.waitKey(0)
cv2.destroyAllWindows() 