import express from 'express';
import Service from '../models/Service.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: Service, resource: 'services' });

export default router;
