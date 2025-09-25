import jwt from 'jsonwebtoken';

/**
 * requireAuth (robust)
 * - Accepts token from:
 *   1) Authorization: Bearer <token> (recommended)
 *   2) Cookies: token | jwt | authToken (if cookie-parser is enabled)
 *   3) Query: ?token= (only if ALLOW_TOKEN_IN_QUERY=1 for dev)
 * - Verifies with JWT_SECRET
 * - Normalizes req.user to always include: id, uid, email, role
 */
export function requireAuth(req, res, next){
  try{
    let token;
    const auth = req.headers.authorization || '';
    const m = auth.match(/^Bearer\s+(.+)$/i);
    if(m) token = m[1];

    // Fallback to cookies (if cookie-parser is used)
    if(!token && req.cookies){
      token = req.cookies.token || req.cookies.jwt || req.cookies.authToken;
    }
    // Optional dev fallback
    if(!token && req.query && process.env.ALLOW_TOKEN_IN_QUERY === '1'){
      token = req.query.token;
    }

    if(!token){
      return res.status(401).json({ message: 'No authorization token provided' });
    }
    const secret = process.env.JWT_SECRET;
    if(!secret){
      return res.status(500).json({ message: 'JWT_SECRET is missing on the server' });
    }

    const decoded = jwt.verify(token, secret);

    const id = decoded.id || decoded.uid || decoded._id;
    req.user = {
      id,
      uid: decoded.uid || id,
      email: decoded.email,
      role: decoded.role,
      ...decoded
    };

    return next();
  }catch(e){
    return res.status(401).json({ message: 'Invalid or expired token', detail: e.message });
  }
  
}


