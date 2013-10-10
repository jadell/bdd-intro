Feature: Shopping Cart
	So that I remember which products I am buying
	As an online shopper
	I want a shopping cart to which I can add products for purchase

Scenario: Adding a single item to the cart
	Given I am on the homepage
	When I follow "Monkey Butter"
		And I press "Add to Cart"
	Then I am on the shopping cart page
		And I see "1" "Monkey Butter" in my cart for "12.45"
		And my grand total is "12.45"

Scenario: Adding the same item increases the quantity
	Given I am on the homepage
	When I follow "Monkey Butter"
		And I press "Add to Cart"
	Then I am on the shopping cart page
		And I have "1" item in my cart
		And I see "2" "Monkey Butter" in my cart for "24.90"
		And my grand total is "24.90"

Scenario: Adding a different item
	Given I am on the homepage
	When I follow "Baboon Grease"
		And I press "Add to Cart"
	Then I am on the shopping cart page
		And I have "2" items in my cart
		And I see "2" "Monkey Butter" in my cart for "24.90"
		And I see "1" "Baboon Grease" in my cart for "29.95"
		And my grand total is "54.85"

Scenario: Emptying the cart clears the cart of purchases
	Given I am on the shopping cart page
	When I press "Empty Cart"
	Then I am on the shopping cart page
		And I have "0" items in my cart
		And my grand total is "0.00"
