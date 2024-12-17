import json
import os

# Read the existing products.json
input_file = 'products.json'
output_file = 'products_with_names_updated.json'

with open(input_file, 'r') as file:
    products = json.load(file)

# Update product names based on image file names
for product in products:
    image_path = product['image']
    base_name = os.path.splitext(os.path.basename(image_path))[0]  # Extract the base file name (no extension)
    product['name'] = base_name  # Update the product name

# Write the updated products to a new file
with open(output_file, 'w') as json_file:
    json.dump(products, json_file, indent=4)

print(f"Updated product names have been saved to {output_file}.")
