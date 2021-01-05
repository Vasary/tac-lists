build:
	docker build -t lists .

shell:
	docker run --name micro-lists --network=vlan0 --rm -it -p 8080:8080 -v /Users/viktor/Projects/take-a-cart/lists/app:/application lists sh