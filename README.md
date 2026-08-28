# Multi-Site Docker Deployment

## Infrastructure
- VPS: <provider>, IP: <IP address>
- OS: Oracle Linux 9
- 3 sites behind a single Nginx reverse proxy on port 80

## Deploy from scratch

### 1. Server prep
    ssh root<IP>
    dnf update -y
    dnf install docker docker-ce-cli container-selinux 
    
### 2. Firewall
    firewall-cmd --permanent --add-service=ssh
    firewall-cmd --permanent --add-service=http
    firewall-cmd --reload
    
### 3. SSH hardening
Edit `/etc/ssh/sshd_config`:
    PasswordAuthentication no
    PermitRootLogin prohibit-password
    systemctl restart ssh

### 4. Clone repo and deploy
    git clone <repo_url>
    cd devops-tesst-task
    docker-compose up -d --build

### 5. Enable Docker to start on boot
    systemctl enable docker
    systemctl enable docker-compose

### 6. Verify
    curl http://<IP>/site1/
    curl http://<IP>/site2/
    curl http://<IP>/site3/
    
## Failure test

### Container crash recovery
    docker stop site2
    docker ps

### Server reboot recovery
    reboot
    docker ps
    curl http://<IP>/site1/
    curl http://<IP>/site2/
    curl http://<IP>/site3/

## Conclusion

The infrastructure is configured to provide high availability for the three sites through Docker containers and Nginx reverse proxy. The system demonstrates resilience to container crashes and server reboots due to the restart policies and container orchestration capabilities of Docker.

## Future improvements

1. Add monitoring and alerting for container health and Nginx performance
2. Implement automated backups for the container data
3. Add SSL/TLS termination for secure HTTPS access
4. Implement load balancing across multiple Nginx reverse proxy instances for improved availability
5. Add automated horizontal scaling for the application containers based on traffic load
6. Implement a continuous integration and continuous deployment (CI/CD) pipeline for automated application updates
