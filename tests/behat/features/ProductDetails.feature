Feature: Product Details
	So that I can determine whether a specific product is what I am looking for
	As an online shopper
	I want a page for each product that gives details about that product

Scenario: View a specific product
	Given I am on the homepage
	When I follow "Monkey Butter"
	Then I am on the product page for "Monkey Butter"
		And the product price is "12.45"
		And the product unit size is "16 oz."

	When I go to the homepage
		And I follow "Baboon Grease"
	Then I am on the product page for "Baboon Grease"
		And the product price is "29.95"
		And the product unit size is "32 oz."