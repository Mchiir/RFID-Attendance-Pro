import requests

url = "http://localhost/IoT_backend/RFID%20Attendance%20Pro/upload.php"
data = {
    "employee": "John Doe",
    "clock_in": "2020-10-10 06:50:50",
    "clock_out": "2020-10-10 17:50:50"
}

response = requests.post(url, data=data)
print(response.text)