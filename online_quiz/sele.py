import os
import re

from tkinter import messagebox
 
os.environ["PATH"] += os.pathsep + r'C:/Users/CEDDU/Dropbox/SE/SELab/SE-Selenium-Materials/Testing Labs/selenium/test/'

from selenium import webdriver as wd

driver=wd.Firefox()

#driver.get("https://google.com")
driver.get("C:\\xampp\\htdocs\\PHP_Project\\online_quiz\\signup.php") 
driver.find_element_by_name("fname").send_keys("Jai")
driver.find_element_by_name("lname").send_keys("Tri")
driver.find_element_by_name("email").send_keys("jainil@gmail.com")
driver.find_element_by_name("phoneno").send_keys("7990783195")
driver.find_element_by_name("uname").send_keys("Jainil")
driver.find_element_by_name("role").send_keys("Teacher")
# driver.find_element_by_name("role").send_keys("Student")
driver.find_element_by_name("pass").send_keys("jt0411")
driver.find_element_by_name("pass2").send_keys("jt0411")
driver.find_element_by_name("rpassword").clear()
driver.find_element_by_name("rpassword").send_keys("jt0411")

#radio button
# driver.find_element_by_xpath("//input[@value='Female']").click()

#check boxes
# driver.find_element_by_name("language1").click()
# driver.find_element_by_name("language2").click()

#submit button
driver.find_element_by_xpath("//input[@type='submit']").click()

#browser.find_element_by_name("uname").send_keys("123")
#a=browser.find_element_by_name("uname").get_attribute("value")

#pattern = re.compile("^([A-Z][a-z]+)$")
#if pattern.match(a):
#	messagebox.showinfo("Title", "Matching")  
#else:
#	messagebox.showinfo("Title", "Not Matching")  
