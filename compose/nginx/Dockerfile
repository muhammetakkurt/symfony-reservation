FROM nginx:stable-alpine

# ADD Custom Config
ADD ./compose/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./compose/nginx/default.conf /etc/nginx/conf.d/default.conf

# Make Directory - Workspace
RUN mkdir -p /var/www/html

# ADD and set Group
RUN addgroup -g 1000 symfony && adduser -G symfony -g symfony -s /bin/sh -D symfony

# Set Group to Workspace
RUN chown symfony:symfony /var/www/html