import express from 'express';
import Feature from '../models/Feature.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: Feature, resource: 'features' });
export default router;
