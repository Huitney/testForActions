FROM ubuntu:latest

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    openjdk-11-jdk \
    python3-pip

# Install CodeQL CLI
RUN curl -L -o codeql.zip https://github.com/github/codeql-cli-binaries/releases/latest/download/codeql-linux64.zip && \
    unzip codeql.zip -d /opt && \
    rm codeql.zip && \
    ln -s /opt/codeql/codeql /usr/local/bin/codeql

# Set working directory
WORKDIR /workspace

# Copy project files
COPY . .

# Entry point
ENTRYPOINT ["/bin/bash"]
