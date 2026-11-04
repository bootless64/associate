# Import necessary libraries
import cv2
import numpy as np
import matplotlib.pyplot as plt

# Load the input image in grayscale mode
# Replace 'image.png' with the path to your image
image = cv2.imread('image.png', 0)

# Define a kernel (structuring element)
# Kernel is a small matrix used to define the neighborhood for the operations
kernel = np.ones((3, 3), np.uint8)  # A 3x3 matrix with all ones

# Erosion: Shrinks bright regions in the image
# Parameters: 
# - src: Input image
# - kernel: Structuring element
# - iterations: Number of times the operation is applied
eroded = cv2.erode(image, kernel, iterations=1)

# Dilation: Expands bright regions in the image
dilated = cv2.dilate(image, kernel, iterations=1)

# Opening: Erosion followed by Dilation, used to remove small objects
opened = cv2.morphologyEx(image, cv2.MORPH_OPEN, kernel)

# Closing: Dilation followed by Erosion, used to fill small holes
closed = cv2.morphologyEx(image, cv2.MORPH_CLOSE, kernel)

# Morphological Gradient: Difference between Dilation and Erosion
gradient = cv2.morphologyEx(image, cv2.MORPH_GRADIENT, kernel)

# Top Hat: Difference between the original image and its opening
tophat = cv2.morphologyEx(image, cv2.MORPH_TOPHAT, kernel)

# Black Hat: Difference between the closing of the image and the original
blackhat = cv2.morphologyEx(image, cv2.MORPH_BLACKHAT, kernel)

# Display results
# Each operation's result is displayed in a separate window

plt.figure(figsize=(10,8))
plt.subplot(421)
plt.imshow(image)
plt.title('Original')
plt.axis('off')

plt.subplot(422)
plt.imshow(gradient)
plt.title('Gradient')
plt.axis('off')

plt.subplot(423)
plt.imshow(eroded)
plt.title('Erosion')
plt.axis('off')

plt.subplot(424)
plt.imshow(dilated)
plt.title('Dilation')
plt.axis('off')

plt.subplot(425)
plt.imshow(opened)
plt.title('Opening')
plt.axis('off')

plt.subplot(426)
plt.imshow(closed)
plt.title('Closing')
plt.axis('off')

plt.subplot(427)
plt.imshow(tophat)
plt.title('Top Hat')
plt.axis('off')

plt.subplot(428)
plt.imshow(blackhat)
plt.title('Black Hat')
plt.axis('off')
plt.show()

cv2.waitKey(0)
cv2.destroyAllWindows()
