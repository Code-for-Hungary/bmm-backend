FROM docker.io/library/mariadb:11.4

# On hosts that run MariaDB themselves, the host's AppArmor profile for
# /usr/sbin/mariadbd also attaches to the server in rootless podman containers,
# and it rejects podman's signals, so the container can never be stopped.
# Running a copy from another path keeps the server out of that profile.
RUN install -D -m 755 /usr/sbin/mariadbd /opt/mariadb/bin/mariadbd
ENV PATH=/opt/mariadb/bin:$PATH
