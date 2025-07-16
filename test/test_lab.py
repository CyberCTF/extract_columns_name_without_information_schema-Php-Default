import pytest
import requests

BASE_URL = "http://localhost:8000/lab.php"

def test_catalog_loads():
    r = requests.get(BASE_URL)
    assert r.status_code == 200
    assert "Product Catalog" in r.text
    assert "Vintage Console" in r.text

def test_product_details_load():
    r = requests.get(BASE_URL + "?id=1")
    assert r.status_code == 200
    assert "Vintage Console" in r.text
    assert "$199.99" in r.text

def test_sqli_error_message():
    # This should trigger an SQL error (invalid column)
    payload = "1 UNION SELECT username,2,3 FROM users-- -"
    r = requests.get(BASE_URL + f"?id={payload}")
    assert r.status_code == 200
    assert "An error occurred" in r.text or "Unknown column" in r.text or "error" in r.text.lower()

def test_sqli_column_guessing():
    # This should NOT trigger an error if 'price' is a valid column
    payload = "1 UNION SELECT price,2,3 FROM products-- -"
    r = requests.get(BASE_URL + f"?id={payload}")
    assert r.status_code == 200
    # Should see a price or at least not an error
    assert "An error occurred" not in r.text 