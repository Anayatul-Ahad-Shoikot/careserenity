from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time

# Set up the drive
driver = webdriver.Edge()

# Test URL
url = "http://careserenity-org.free.nf/index.php"

def login(username, password, role):
    driver.get(url + 'login.php')
    time.sleep(2)
    
    # Find login elements and perform login
    driver.find_element(By.CLASS_NAME, "rb@gmail.com").send_keys(username)
    driver.find_element(By.CLASS_NAME, "1111").send_keys(password)
    driver.find_element(By.CLASS_NAME, "login_button").click()
    time.sleep(2)

    # if login was successful by verifying the role's dashboard page
    assert role in driver.page_source, "Login Failed for user role: " + role

def sign_up(email, password, confirm_password, role, question, answer):
    driver.get(url + 'signup.php')
    time.sleep(2)
    
    # Fill out the signup form
    driver.find_element(By.NAME, "acc_email").send_keys(email)
    driver.find_element(By.NAME, "acc_pass").send_keys(password)
    driver.find_element(By.NAME, "confirm_pass").send_keys(confirm_password)
    
    # Select account type
    select_role = driver.find_element(By.NAME, "role")
    for option in select_role.find_elements(By.TAG_NAME, 'option'):
        if option.text == role:
            option.click()
            break

    # Select security question
    select_question = driver.find_element(By.NAME, "question")
    for option in select_question.find_elements(By.TAG_NAME, 'option'):
        if option.text == question:
            option.click()
            break

    # Input the answer to the security question
    driver.find_element(By.NAME, "answer").send_keys(answer)
    
    # Submit the form
    driver.find_element(By.NAME, "signup_btn").click()
    time.sleep(2)

    # if signup was successful
    assert "Account created" in driver.page_source, "Signup Failed"

def arrange_seminar(seminar_name, date, description):
    # Navigate to the organization dashboard and seminar page
    driver.get(url + 'dashboard/org_seminar.php')
    time.sleep(2)
    
    # Fill out seminar details
    driver.find_element(By.CLASS_NAME, "seminar_name").send_keys(seminar_name)
    driver.find_element(By.CLASS_NAME, "seminar_date").send_keys(date)
    driver.find_element(By.CLASS_NAME, "seminar_desc").send_keys(description)
    driver.find_element(By.CLASS_NAME, "create_seminar_button").click()
    time.sleep(2)

    # if seminar was created successfully
    assert "Seminar created successfully" in driver.page_source, "Seminar Creation Failed"

def create_blog(blog_title, content):
    # Navigate to blog creation page for organizations
    driver.get(url + 'dashboard/org_blog.php')
    time.sleep(2)
    
    # Fill out blog form
    driver.find_element(By.CLASS_NAME, "blog_title").send_keys(blog_title)
    driver.find_element(By.CLASS_NAME, "blog_content").send_keys(content)
    driver.find_element(By.CLASS_NAME, "create_blog_button").click()
    time.sleep(2)

    # if blog post was created successfully
    assert "Blog created successfully" in driver.page_source, "Blog Creation Failed"

def donate_to_child(organization_id, child_id, amount, payment_method):
    # Navigate to the donation page
    driver.get(url + f'donation_page.php?org_id={organization_id}&child_id={child_id}')
    time.sleep(2)

    # Fill out donation form
    driver.find_element(By.CLASS_NAME, "donation_amount").send_keys(str(amount))
    driver.find_element(By.CLASS_NAME, "payment_method").send_keys(payment_method)
    driver.find_element(By.CLASS_NAME, "donate_button").click()
    time.sleep(2)

    # if donation was successful
    assert "Donation successful" in driver.page_source, "Donation Failed"

def join_seminar(seminar_id):
    # Navigate to seminar list page
    driver.get(url + 'seminars.php')
    time.sleep(2)

    # Find the seminar and click to join
    seminar_button = driver.find_element(By.XPATH, f"//button[@data-seminar-id='{seminar_id}']")
    seminar_button.click()
    time.sleep(2)

    # if user has joined the seminar successfully
    assert "You have successfully joined the seminar" in driver.page_source, "Failed to Join Seminar"

# Run tests
try:
    # Test 1: User Signup and Login
    sign_up("testuser@example.com", "1234", "1234", "user", "What is your favorite movie?", "Avengers")
    login("testuser@example.com", "1234", "role")

    # Test 2: Organization Signup and Login, Create Seminar and Blog
    sign_up("org@example.com", "pas123", "organization")
    login("org@example.com", "pas123", "organization")
    arrange_seminar(
        seminar_name="Charity Event",
        subject="Helping Children",
        description="AAAAAAAAAAAAAAAAA",
        date="2024-12-25",
        guest="abc, xyz",
        seminar_type="offline",
        location="1234, Dhaka, BD",
        banner_path="./assets/banner_3.jpg"
    )

    create_blog("New Blog Post", "This is a sample blog post for the organization.")

    # Test 3: User Donation to a Child
    donate_to_child(organization_id=1, child_id=2, amount=100, payment_method="BKash")

    # Test 4: User Joins a Seminar
    join_seminar(seminar_id=1)

finally:
    # Close the browser after testing
    driver.quit()
