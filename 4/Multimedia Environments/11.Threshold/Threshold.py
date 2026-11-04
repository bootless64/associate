import cv2
import numpy as np

image = cv2.imread('image.png',0)

# # Explanation:
# # cv2.threshold(src, thresh, maxval, type)
# # - src: Input image (grayscale)
# # - thresh: Threshold value
# # - maxval: Maximum value to assign for pixels above the threshold
# # - type: Type of thresholding (e.g., THRESH_BINARY)

# Simple Binary Threshold
ret, th1 = cv2.threshold(image, 127, 255, cv2.THRESH_BINARY)

# Binary Inverted Threshold
ret, th2 = cv2.threshold(image, 127, 255, cv2.THRESH_BINARY_INV)

# Truncate Threshold
ret, th3 = cv2.threshold(image, 127, 255, cv2.THRESH_TRUNC)

# Threshold to Zero
ret, th4 = cv2.threshold(image, 127, 255, cv2.THRESH_TOZERO)

# Threshold to Zero Inverted
ret, th5 = cv2.threshold(image, 127, 255, cv2.THRESH_TOZERO_INV)

# cv2.imshow("Original", image)
# cv2.imshow("Binary", th1)
# cv2.imshow("Binary Inv", th2)
# cv2.imshow("Truncate", th3)
# cv2.imshow("To Zero", th4)
# cv2.imshow("To Zero Inv", th5)


# Apply adaptive Gaussian thresholding
adaptive_gaussian = cv2.adaptiveThreshold(
    image,
    255,                    # max value
    cv2.ADAPTIVE_THRESH_GAUSSIAN_C,
    cv2.THRESH_BINARY,
    11,                     # block size
    2                       # constant subtracted from weighted sum
)
# cv2.imshow("Adaptive Gaussian", adaptive_gaussian)


# Apply Otsu's thresholding
# The threshold value is automatically computed by OpenCV
ret, otsu = cv2.threshold(
    image,
    0, # ignored when using Otsu
    255,
    cv2.THRESH_BINARY + cv2.THRESH_OTSU
)
print("Selected threshold value:", ret)
cv2.imshow("Otsu Threshold", otsu)

cv2.waitKey(0)
cv2.destroyAllWindows()