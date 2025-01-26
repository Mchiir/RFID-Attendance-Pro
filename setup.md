# IoT-Backend

## RFID-Attendance-Pro System - Guidance

post data using a simple test.py after installing requests module

    import requests

    url = "https://projects.benax.rw/f/o/r/e/a/c/h/p/r/o/j/e/c/t/s/629925151a2068e167771fdf7d3ed8c6/RFID-Attendance-Pro_System/upload.php"
    data = {
        "employee": "John Doe",
        "clock_in": "2020-10-10 06:50:50",
        "clock_out": "2020-10-10 17:50:50"
    }

    response = requests.post(url, data=data)
    print(response.text)

    https://foreach.benax.rw/?go=run-code&file=L2hvbWUvYmVuYXgvcHJvamVjdHMuYmVuYXgucncvZi9vL3IvZS9hL2MvaC9wL3Ivby9qL2UvYy90L3MvNjI5OTI1MTUxYTIwNjhlMTY3NzcxZmRmN2QzZWQ4YzYvUkZJRC1BdHRlbmRhbmNlLVByb19TeXN0ZW0vaW5kZXgucGhw

    after activation, you'll get a shorter url

    curl -X POST \
    -H "Content-Type: application/x-www-form-urlencoded" -d "employee=Habimana claude" -d clock_in=2020-10-10 06:50:50" \
    -d "clock_out=2020-10-10 17:50:50" \
    "https://projects.benax.rw/f/o/r/e/a/c/h/p/r/o/j/e/c/t/s/629925151a2068e167771fdf7d3ed8c6/RFID-Attendance-Pro_System/upload.php"