from graphviz import Digraph

# Create ER diagram
er = Digraph('ER_Diagram', filename='walkon_er_diagram', format='png')

# Entities
er.node('Product', 'Product\n(product_id, name, brand, price, material, color, size, stock)')
er.node('Users', 'Users\n(id, username, phone_no, email, password, role)')
er.node('User_Orders', 'User_Orders\n(order_id, user_id, product_id, quantity, total_price, name, phone, email, address, district, street, payment_method, created_at, order_status)')

# Relationships
er.edge('Users', 'User_Orders', label='places (1:N)')
er.edge('Product', 'User_Orders', label='contains (1:N)')

# Render ER diagram
er_path = "/mnt/data/walkon_er_diagram.png"
er.render(er_path, format="png", cleanup=True)
er_path
