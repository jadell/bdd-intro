Feature: Product Listing
	So that I can easily find the products I am looking for
	As an online shopper
	I want to see a list of all the available products

Scenario: All products appear on the homepage
	Given I am on the homepage
	Then I see the following list of products:
		| name                         | price | unit   |
		| Monkey Butter                | 12.45 | 16 oz. |
		| Baboon Grease                | 29.95 | 32 oz. |
		| Relative Bearing Lubricant   |  6.75 |  2 oz. |
