import pandas as pd
import mysql.connector
import matplotlib.pyplot as plt
from flask import session 
import sys

if len(sys.argv) < 2:
    print("No user ID passed!", sys.argv)
    sys.exit()

current_user_id = sys.argv[1]

conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="multibusinessbookingsystem"
)

#current_user_id = session.get('user_id')

cursor = conn.cursor()

query = "SELECT order_date, total_price FROM customer_orders WHERE product_owner_id = %s"
#cursor.execute(query, (current_user_id))
df = pd.read_sql(query, conn, params=(current_user_id,))   
conn.close()

if df.empty:
    print("No orders found for this user.")
    sys.exit()

df['order_date'] = pd.to_datetime(df['order_date'])
df['month'] = df['order_date'].dt.to_period('M')
monthly_sales = df.groupby('month')['total_price'].sum()

plt.figure(figsize=(10,6))
monthly_sales.plot(kind='bar', color='skyblue')
plt.title('Monthly sales')
plt.xlabel('Month')
plt.ylabel('Total sales')
plt.xticks(rotation=45)
plt.tight_layout()

plt.savefig("sales_graph.png")
#print("Graph generated sucessfully")
