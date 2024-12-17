import os
import json
import random

# Define the directory containing images
image_folders = [
    r'C:\xampp\htdocs\walkon\assets\img\ADIDAS',
    r'C:\xampp\htdocs\walkon\assets\img\CONVERSE',
    r'C:\xampp\htdocs\walkon\assets\img\JORDAN',
    r'C:\xampp\htdocs\walkon\assets\img\NIKE',
    r'C:\xampp\htdocs\walkon\assets\img\PUMA'
]

output_file = 'products.json'

# Get list of all image files from each folder
image_files = []
for folder in image_folders:
    image_files.extend(f for f in os.listdir(folder) if f.endswith(('.png', '.jpg', '.jpeg')))

# Create product data
products = []
for idx, image_file in enumerate(image_files, start=1):
    product_name = f"ProductName {idx}"
    price = random.randint(50, 500)  # Random price between 50 and 500
    image_path = os.path.join(folder, image_file)
    
    products.append({
        "id": idx,
        "name": product_name,
        "price": price,
        "image": image_path
    })

# Write the JSON file
with open(output_file, 'w') as json_file:
    json.dump(products, json_file, indent=4)

print(f"products.json has been created with {len(products)} items.")
