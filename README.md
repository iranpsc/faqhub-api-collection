
# FAQ Hub API Collection

This project is a collection of APIs for the **FAQ Hub** system, which allows you to efficiently manage and serve Frequently Asked Questions (FAQs). The API enables you to add, edit, delete, and retrieve FAQs.

**Note**: This API is specifically designed for the [FAQ Hub Livewire](https://github.com/iranpsc/faqhub-livewire.git) project. To use the API, you need to run both the **API** and **Livewire** projects simultaneously in your local environment.

**Another note**: The API should be running on port `8001`, and the Livewire project should be running on port `8000` for them to work properly together.

## Features

- **Manage FAQs**: Add, edit, and delete FAQs.
- **Retrieve FAQ List**: Retrieve all FAQs in JSON format.
- **RESTful API**: Uses standard HTTP methods for interacting with the API.
- **JSON Response**: All responses are returned in JSON format.
- **Scalable**: Designed for high-traffic systems.

## Installation and Setup

### Installation Steps

1. Clone the **API** project:
   ```bash
   git clone https://github.com/iranpsc/faqhub-api-collection.git
   ```

2. Clone the **Livewire** project:
   ```bash
   git clone https://github.com/iranpsc/faqhub-livewire.git
   ```

3. Navigate to the **API** project folder:
   ```bash
   cd faqhub-api-collection
   ```

4. Install the dependencies for the **API** project:
   ```bash
   npm install
   ```

5. Navigate to the **Livewire** project folder:
   ```bash
   cd ../faqhub-livewire
   ```

6. Install the dependencies for the **Livewire** project:
   ```bash
   npm install
   ```

7. Now, go back to the **API** project and copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

   Then, configure the environment variables like `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, and other settings as per your needs.

8. Run database migrations for the **API** project (if required):
   ```bash
   php artisan migrate
   ```

9. Start the **API** server on port 8001:
   ```bash
   php artisan serve --port=8001
   ```

10. Start the **Livewire** project on port 8000:
    ```bash
    php artisan serve --port=8000
    ```

11. Now, both the **API** and **Livewire** projects should be running simultaneously in your local environment.

## Contributing

We welcome contributions to this project! If you would like to help improve it, you can:

1. Open a **new issue** on GitHub.
2. Submit a **pull request**.

Before submitting a pull request, please follow these guidelines:
- Ensure your changes are compatible with the existing code.
- Write appropriate tests to ensure the system works correctly.
- Update API documentation and any relevant changes.

## License

This project is licensed under the **MIT** License. For more details, please see the [LICENSE](LICENSE) file.

---

Thank you for your interest in this project! We hope this system helps you manage your FAQs in an efficient way.
```



