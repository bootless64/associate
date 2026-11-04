import cv2
import numpy as np
from matplotlib import pyplot as plt

# Create a sample image (e.g., a colorful image)
# For demonstration, let's create a simple image with distinct color regions.
# In a real scenario, you would load an image using cv2.imread('your_image.jpg')

image_bgr = np.zeros((300, 300, 3), dtype=np.uint8)

# Blue region
image_bgr[50:150, 50:150] = [255, 0, 0]  # B=255, G=0, R=0
# Green region
image_bgr[50:150, 150:250] = [0, 255, 0]  # B=0, G=255, R=0
# Red region
image_bgr[150:250, 50:150] = [0, 0, 255]  # B=0, G=0, R=255
# White region
image_bgr[150:250, 150:250] = [255, 255, 255] # B=255, G=255, R=255

# Convert BGR to Grayscale
image_gray = cv2.cvtColor(image_bgr, cv2.COLOR_BGR2GRAY)

# # Convert BGR to HSV
image_hsv = cv2.cvtColor(image_bgr, cv2.COLOR_BGR2HSV)

# plt.figure(figsize=(10,15))

# plt.subplot(3,2,1)
# plt.imshow(image_bgr)
# plt.title('image_bgr')
# plt.axis('off')
# # matplotlib does'nt understand bgr
# plt.subplot(3,2,2)
# plt.imshow(cv2.cvtColor(image_bgr,cv2.COLOR_BGR2RGB))
# plt.title('real bgr image')
# plt.axis('off')

# plt.subplot(3,2,3)
# plt.imshow(image_gray)
# plt.title('image_gray')
# plt.axis('off')
# #plt.imshow default image is a color image, so we use cmap='gray' for grayscale images
# plt.subplot(3,2,4)
# plt.imshow(image_gray,cmap='gray')
# plt.title('image_gray')
# plt.axis('off')

# plt.subplot(3,2,5)
# plt.imshow(image_hsv)
# plt.title('image_hsv')
# plt.axis('off')

# plt.show()

#HSV images
img = cv2.imread('img1.jpg')
image = cv2.cvtColor(img , cv2.COLOR_BGR2HSV)

H = image[: , : , 0]
S = image[: , : , 1]
V = image[: , : , 2]

add_H = cv2.add(H , 50)
add_S = cv2.add(S , 50)
add_V = cv2.add(V , 50)

# cv2.imshow('Main image', img )

# H_color = cv2.merge([add_H , S , V])
# cv2.imshow('Changed color image', cv2.cvtColor(H_color, cv2.COLOR_HSV2BGR))

# S_Contrast = cv2.merge([H , add_S , V])
# cv2.imshow('High saturated image', cv2.cvtColor(S_Contrast, cv2.COLOR_HSV2BGR))

# V_lighter= cv2.merge([ H , S , add_V])
# cv2.imshow('Lighter image', cv2.cvtColor(V_lighter, cv2.COLOR_HSV2BGR))


# #Alpha Channel (4th channel)
transparet = cv2.imread('transparent.png' , cv2.IMREAD_UNCHANGED) #imread default: BGR
print(transparet.shape)

B , G , R , T = cv2.split(transparet)
plt.imshow(T,cmap='gray')
plt.show()


cv2.waitKey()
cv2.destroyAllWindows()




# --- Explanation and Comparison ---

# print("Explanation of Color Channels in Image Processing with OpenCV:")

# print("1. BGR Color Channel (Blue, Green, Red):")
# print("   - This color format is the default in OpenCV.")
# print("   - The image consists of a combination of three channels: blue, green, and red.")
# print("   - Each pixel is represented by a combination of the intensity of these three primary colors.")
# print("   - It has a high intuitive understanding for humans as it matches how we perceive colors (though the order is BGR, not RGB).")

# print("2. Grayscale Channel:")
# print("   - This format converts the image to a single color.")
# print("   - Each pixel has only one intensity value (typically from 0 to 255).")
# print("   - 0 represents absolute black and 255 represents absolute white.")
# print("   - In many image processing algorithms, such as edge detection, noise removal, and texture analysis, using grayscale images is essential or extremely useful as it reduces computational complexity.")

# print("3. HSV Color Channel (Hue, Saturation, Value):")
# print("   - Hue: represents the type of color (like red, blue, green).")
# print("   - Saturation: indicates the purity or intensity of the color. High saturation means pure color, while low saturation means muted color or close to gray.")
# print("   - Value: represents the brightness of the color (similar to grayscale).")
# print("   - The HSV format is often useful in applications that need to separate colors based on hue and saturation, such as color-based object segmentation, color tracking, and color adjustment. It is also less sensitive to changes in lighting conditions (especially the Hue channel).")

# print("Comparison of Color Channels:")
# print("----------------------")
# print(" - BGR: Suitable for natural color representation and human visual understanding.")
# print(" - Grayscale: Ideal for reducing data dimensions, focusing on brightness information, and using in foundational image processing algorithms.")
# print(" - HSV: Highly efficient for color analysis independent of brightness and specific applications like color tracking and object detection based on color features.")

# # Advantages and Disadvantages
# print("\nAdvantages and Disadvantages of Each Method:")
# print("---------------------------------------------------")
# print("BGR:")
# print(" - Advantages: Intuitive for humans, high color fidelity.")
# print(" - Disadvantages: Not optimal for color-based processing, can be affected by lighting changes.")

# print("Grayscale:")
# print(" - Advantages: Reduces complexity, retains intensity information for analysis.")
# print(" - Disadvantages: Loses color information, not suitable for color-based tasks.")

# print("HSV:")
# print(" - Advantages: Separates color from brightness, good for color tracking and detection.")
# print(" - Disadvantages: Interpretation can be less intuitive than RGB; requires conversion back for some processes.")