FROM php:8.0

# Set the working directory inside the container
WORKDIR /app

# Copy the application files into the container
COPY . .

# Expose port 3000 (This is just metadata and doesn't actually publish the port)
EXPOSE 3000

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Start the PHP built-in web server
CMD ["php", "-S", "0.0.0.0:3000"]

