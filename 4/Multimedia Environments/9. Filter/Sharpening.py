import cv2
import numpy as np
import matplotlib.pyplot as plt

image = cv2.imread('Sharpening.jpg', 0)
gaussian_filtered = cv2.GaussianBlur(image, (5,5), sigmaX=1)
sharpened = cv2.addWeighted(image, 2, gaussian_filtered, -1, 0)

plt.figure(figsize=(15,20))
plt.subplot(1, 2, 1)
plt.imshow(image, cmap='gray')
plt.title('Original')
plt.axis('off')

plt.subplot(1, 2, 2)
plt.imshow(sharpened, cmap='gray')
plt.title('sharpened')
plt.axis('off')

plt.show()

cv2.waitKey()
cv2.destroyAllWindows