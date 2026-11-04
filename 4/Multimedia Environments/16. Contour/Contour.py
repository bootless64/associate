import cv2
import numpy as np 

image = cv2.imread('image.jpg')
gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
image = cv2.resize(gray,(500,500))
cv2.imshow('Original Image', image)
_, binary = cv2.threshold(image, 127, 255, cv2.THRESH_BINARY)

# Find contours
# cv2.findContours(image, mode, method): Detects contours in a binary image
# - image: Input binary image (usually from thresholding or edge detection)
# - mode: Contour retrieval mode (e.g., cv2.RETR_TREE retrieves all contours and reconstructs a full hierarchy)
# - method: Contour approximation method (e.g., cv2.CHAIN_APPROX_SIMPLE compresses horizontal, vertical, and diagonal segments)
# Returns: A tuple of contours and the hierarchy
contours, hierarchy = cv2.findContours(binary, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)
print(contours)
area = cv2.contourArea(contours[0])
print("Area:", area)

# Draw the contours
# cv2.drawContours(image, contours, contourIdx, color, thickness): Draws contours on an image
# - image: Input image on which to draw
# - contours: List of contours to draw (from cv2.findContours)
# - contourIdx: Index of the contour to draw (-1 means all contours)
# - color: Color of the contour lines (e.g., (0, 255, 0) for green)
# - thickness: Thickness of the contour lines (e.g., 2 for a line of 2 pixels)
# Returns: The image with contours drawn on it
contoured_image = cv2.drawContours(image, contours, 0, (0, 255, 0), 2)


cv2.imshow('Contours', contoured_image)

cv2.waitKey(0)
cv2.destroyAllWindows()