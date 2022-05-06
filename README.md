# GraphQL vs REST

Simple application to compare GraphQL and REST

## Structure:
    
````
    Categories:
        id
        name
        slug
        status
        
    Products:
        id
        name
        price
        status
        category_id

````

## REST ENDPOINTS

````
    GET|HEAD   api/categories .................................. api.categories.index › Api\CategoryController@index
    POST       api/categories .................................. api.categories.create › Api\CategoryController@create
    GET|HEAD   api/categories/{category} ....................... api.categories.update › Api\CategoryController@update
    DELETE     api/categories/{category} ....................... api.categories.destroy › Api\CategoryController@destroy
    GET|HEAD   api/products .................................... api.products.index › Api\ProductController@index
    GET|HEAD   api/products/{product} .......................... api.products.show › Api\ProductController@show

````

## GraphQL Endpoint
````
    POST       graphql ......................................... graphql › Nuwave\Lighthouse › GraphQLController
````

## GraphQL Schema

### Category Schema
````
    //BASE MODEL
    type Category
    {
        id: ID!
        name: String!,
        slug: String!
        status: Int!
        products: [Product!] @hasMany(type: PAGINATOR)
    }
    
    extend type Query
    {
        categories: [Category!]! @paginate(defaultCount: 3)
        category(
            id: ID @eq @rules(apply: ["prohibits:slug", "required_without:slug"])
            slug: String @eq @rules(apply: ["prohibits:id", "required_without:id"])
        ): Category @find
    }
    
    extend type Mutation
    {
        createCategory(input: CategoryInput! @spread): Category @create
        updateCategory(input: CategoryUpdateInput! @spread): Category @update
        deleteCategory(id: ID!): Category @delete
    }
    
    input CategoryInput
    {
        name: String! @rules(apply: ["string", "unique:categories,name"])
        status: Int @rules(apply: ["int", "min:0", "max:1"])
    }
    
    input CategoryUpdateInput @validator
    {
        id: ID!
        name: String
        status: Int
    }
````

### Product Schema
````
    type Product
    {
        id: ID!
        name: String!
        slug: String!
        price: Int
        category: Category! @belongsTo
    }
    
    extend type Query
    {
        products: [Product!]! @paginate(defaultCount: 3)
        product(
            id: ID @eq @rules(apply: ["prohibits:slug", "required_without:slug"])
    
            slug: String @eq @rules(apply: ["prohibits:id", "required_without:id"])
        ): Product @find
    }

````
