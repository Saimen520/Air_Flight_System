import requests


url = 'http://localhost/Air_Flight_System/Booking_App/View/user_data.xml'


headers = {
    'Content-Type': 'application/xml'  
}

try:
    response = requests.get(url, headers=headers)

    # Check if the request was successful
    if response.status_code == 200:
        # Print the XML response
        print("Response XML:")
        print(response.text)
    else:
        print(f"Failed to retrieve data. Status code: {response.status_code}")
        print(f"Response: {response.text}")

except requests.exceptions.RequestException as e:
    print(f"An error occurred: {e}")
